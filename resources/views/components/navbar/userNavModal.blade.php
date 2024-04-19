<div x-cloak x-show="userNavModal" class="bg-white fixed top-14 right-0 md:right-5 z-50">
    <div class="z-50 min-w-[8rem] overflow-hidden rounded-md border bg-popover p-1 text-popover-foreground shadow-md"
        tabindex="-1">
        <div class="px-2 py-1.5 text-sm font-semibold"><a href="{{ route('profile') }}">My Account</a></div>
        <div role="separator" class="-mx-1 my-1 h-px bg-muted"></div>
        <div role="menuitem"
            class="relative flex cursor-default select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none transition-colors focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
            Settings</div>
        <div role="menuitem"
            class="relative flex cursor-default select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none transition-colors focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
            Support</div>
        <div role="separator" class="-mx-1 my-1 h-px bg-muted"></div>
        <a role="menuitem" href="{{ route('logout') }}" wire:navigate
            class="relative flex select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none transition-colors focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50 cursor-pointer">
            Logout</a>
    </div>
</div>
