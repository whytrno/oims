<?php

function toast($message)
{
    session()->flash('toast_message', $message);
}
