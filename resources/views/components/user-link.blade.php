<!-- resources/views/components/user-link.blade.php -->
@props(['user', 'back', 'title' => ''])

<a href="{{ $back }}" class="d-inline-flex px-2">
    <i class="bi bi-arrow-right text-dark" style="font-size: 25px; line-height: 0; "></i>
</a>

<div class="user-info d-flex align-items-center">
    <x-avatar-container class="me-2">
        <x-avatar :user="$user" />
    </x-avatar-container>
    <div class="d-flex flex-column ml-2">
        <p class="mb-0" style="font-size: 10px">{{ $user->full_name }}</p>
        <p class="mb-0" style="font-size: 8px;letter-spacing: 0.0001em !important">{{ $title }}</p>
    </div>
</div>
