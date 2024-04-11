<div class="flex justify-between items-center">
    <div class="flex flex-col gap-1">
        <h1 class="text-lg font-semibold md:text-2xl">Karyawan</h1>
        <nav aria-label="breadcrumb" class="flex">
            <ol class="flex flex-wrap items-center gap-1.5 break-words text-sm text-muted-foreground sm:gap-2.5">
                <li class="inline-flex items-center gap-1.5"><a class="transition-colors hover:text-foreground"
                        href="https://oims-apps.my.id"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-home size-4">
                            <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </a>
                </li>
                <li role="presentation" aria-hidden="true" class="[&amp;>svg]:size-3.5"><svg width="15"
                        height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6.1584 3.13508C6.35985 2.94621 6.67627 2.95642 6.86514 3.15788L10.6151 7.15788C10.7954 7.3502 10.7954 7.64949 10.6151 7.84182L6.86514 11.8418C6.67627 12.0433 6.35985 12.0535 6.1584 11.8646C5.95694 11.6757 5.94673 11.3593 6.1356 11.1579L9.565 7.49985L6.1356 3.84182C5.94673 3.64036 5.95694 3.32394 6.1584 3.13508Z"
                            fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </li>
                <li class="inline-flex items-center gap-1.5">
                    <a class="transition-colors hover:text-foreground" href="https://oims-apps.my.id/karyawan">Karyawan
                    </a>
                </li>
            </ol>
        </nav>
    </div>

    <div class="flex gap-2">
        <a href="{{ route('users.export') }}"
            class="inline-flex items-center justify-center whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground shadow hover:bg-primary/90 rounded-md px-3 text-xs h-7 gap-1">
            <iconify-icon icon="mdi:table-export"></iconify-icon>
            <span class="sr-only sm:not-sr-only sm:whitespace-nowrap">Export</span>
        </a>

        @if (Auth::user()->role_id === 1)
            <a href="{{ route('users.create') }}"
                class="inline-flex items-center justify-center whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground shadow hover:bg-primary/90 rounded-md px-3 text-xs h-7 gap-1"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-circle-plus h-3.5 w-3.5">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M8 12h8"></path>
                    <path d="M12 8v8"></path>
                </svg>
                <span class="sr-only sm:not-sr-only sm:whitespace-nowrap">Add Data</span>
            </a>
        @endif
    </div>
</div>
