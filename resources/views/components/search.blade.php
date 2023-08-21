@props(['action' => '', 'keyword' => ''])

<form action="{{ $action }}" class="m-0 p-0" method="GET">
    <div class="input-group position-relative">
        <i class="bi bi-search position-absolute top-50 end-0 pe-2 pt-1 translate-middle-y text-muted"></i>
        <label>
            <input type="text" class="search-input form-control form-control-sm border-0 border-bottom" style="border-radius: 0;" name="keyword" placeholder="جستجو..."
                   value="{{ $keyword }}">
        </label>

    </div>
</form>
<style>
    /* Remove outline when input is focused */
    .search-input:focus {
        outline: none;
        border: none;
        box-shadow: none;
    }
</style>
