<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $keyword = request()->input('keyword');
        $users = User::query()
            ->when($keyword, function ($query, $keyword) {
                return $query->search($keyword);
            })->orderByDesc('id')->paginate(10);

        return view('users.index', compact('users', 'keyword'));
    }

    public function invoices(User $user)
    {
        $keyword = request()->input('keyword');

        $invoices = Invoice::query()
            ->where('user_id', $user->id)
            ->with('user')
            ->when($keyword, function ($query, $keyword) {
                return $query->search($keyword);
            });

        if (request()->has('user_id')) {
            $invoices = $invoices->where('user_id', request()->input('user_id'));
        }

        $invoices = $invoices->orderByDesc('id')->paginate(10);
        $invoices->appends(request()->query());

        return view('users.invoices', compact('invoices', 'user', 'keyword'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['avatar'] = $this->uploadAvatarAndGetPath($request);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['mobile_verified_at'] = now();

        User::create($validatedData);

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('avatar')) {
            $validatedData['avatar'] = $this->uploadAvatarAndGetPath($request);
        }

        // Update the user
        $user->update($validatedData);

        // Redirect to user list
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        if ($user->invoices()->exists()) {
            return redirect()->back()->with('error', __('messages.User cannot be deleted because it has associated invoices.'));
        }

        // Delete the user
        $user->delete();

        // Redirect to user list
        return redirect()->route('users.index');
    }

    private function uploadAvatarAndGetPath(Request $request): string|null
    {
        $path = null;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $randomName = Str::random(40);
            $extension = $file->getClientOriginalExtension();
            $folder = date('Y-m-d'); // Get the current date as the folder name
            $fileName = $randomName.'_'.date('His').'.'.$extension;

            $path = $file->storeAs('avatars/'.$folder, $fileName, 'public');
        }

        return $path;
    }

    public function search(Request $request): JsonResponse
    {
        $request = request();

        $users = User::query()->limit(4)->select('id', 'full_name');

        if ($request->has('search') && $request->search != '') {
            $users = $users->where('full_name', 'like', '%'.$request->search.'%');
        }

        $users = $users->get();

        return response()->json($users->toArray());
    }
}
