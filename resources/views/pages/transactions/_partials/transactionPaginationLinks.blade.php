<div class="mt-auto flex w-full justify-center p-4 lg:justify-start">
    <div class="join">
        <a
            class="@if($transactions->onFirstPage()) btn-disabled @endif btn join-item btn-sm"
            href="{{ $transactions->withQueryString()->previousPageUrl() }}">
            «
        </a>
        <a class="btn join-item btn-sm">
            @lang('globals.page')
            {{ $transactions->currentPage() }}
        </a>
        <a
            class="@if($transactions->onLastPage()) btn-disabled @endif btn join-item btn-sm"
            href="{{ $transactions->withQueryString()->nextPageUrl() }}">
            »
        </a>
    </div>
</div>
