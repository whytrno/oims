<div class="bg-white fixed top-14 right-0 md:right-5">
    <div id="user-nav-modal" data-side="bottom" data-align="end" role="menu" data-state="closed" data-radix-menu-content=""
        dir="ltr" id="radix-:r4:" aria-labelledby="radix-:r3:"
        class="data-[state=closed]:hidden z-50 min-w-[8rem] overflow-hidden rounded-md border bg-popover p-1 text-popover-foreground shadow-md data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 data-[side=bottom]:slide-in-from-top-2 data-[side=left]:slide-in-from-right-2 data-[side=right]:slide-in-from-left-2 data-[side=top]:slide-in-from-bottom-2"
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
        <a role="menuitem" href="{{ route('logout') }}"
            class="relative flex select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none transition-colors focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50 cursor-pointer">
            Logout</a>
    </div>
</div>
