<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogFooter, DialogHeader, DialogTrigger } from '@/components/ui/dialog';
</script>

<template>
    <Dialog>
        <DialogTrigger as-child>
            <slot name="trigger" />
        </DialogTrigger>
        <DialogContent class="sm:max-w-[50rem]">
            <DialogHeader>
                <slot name="header" />
            </DialogHeader>
            <slot />
            <DialogFooter>
                <Button type="submit"> Save changes </Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>
