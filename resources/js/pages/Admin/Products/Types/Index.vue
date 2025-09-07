<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head :title="info.title" />
        <div class="p-4">
            <div class="flex h-full flex-col space-y-6">
                <HeadingSmall :title="info.title" :description="info.description" />
                <div class="h-[29rem]">
                    <form @submit.prevent="handleSearch">
                        <div class="mb-4 flex w-full items-center">
                            <Button class="h-10 w-27 rounded-r-none bg-teal-600 uppercase hover:bg-teal-700" as-child
                                ><Link href="/admin/products/types/create"><Icon code="fa6-solid:plus" /> New</Link>
                            </Button>
                            <Input v-model="search" class="h-10 rounded-none" id="search" type="text" placeholder="Search" />
                            <Button class="h-10 w-27 rounded-l-none bg-teal-600 uppercase hover:bg-teal-700" type="submit">
                                <Icon code="heroicons:magnifying-glass-16-solid" /> Cari
                            </Button>
                        </div>
                    </form>
                    <Table>
                        <!-- <TableCaption>A list of your recent invoices.</TableCaption> -->
                        <TableHeader>
                            <TableRow>
                                <TableHead> Name </TableHead>
                                <TableHead class="w-[12em]"> Width </TableHead>
                                <TableHead class="w-[12em]"> Height </TableHead>
                                <TableHead class="w-[12em]"> Price </TableHead>
                                <TableHead> Description </TableHead>
                                <TableHead class="w-[20em] text-center"> Actions </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="(value, id) in types.data" :key="id">
                                <TableCell class="content-start text-start text-base">
                                    {{ value.name }}
                                </TableCell>
                                <TableCell class="content-start text-start text-base">
                                    {{ `${value.width} cm` }}
                                </TableCell>
                                <TableCell class="content-start text-start text-base">
                                    {{ `${value.height} cm` }}
                                </TableCell>
                                <TableCell class="content-start text-start text-base">
                                    {{ `${formatPrice2(value.price)}` }}
                                </TableCell>
                                <TableCell class="content-start text-start text-base">
                                    {{ value.description }}
                                </TableCell>
                                <TableCell class="content-start text-center">
                                    <Button class="mr-2 bg-green-600 hover:bg-green-700" size="sm" as-child
                                        ><Link :href="`/admin/products/types/${value.id}/edit`"> <Icon code="fa6-solid:pencil" /> Edit </Link></Button
                                    >
                                    <AlertDialog
                                        @confirm="handleConfirmDelete(value)"
                                        iconTrigger="fa6-solid:trash"
                                        textTrigger="Delete"
                                        title="Yakin hapus cluster ini?"
                                        description="Cluster ini akan dihapus secara permanen."
                                        cancelText="Batal"
                                        confirmText="Hapus"
                                        type="warning"
                                    >
                                    </AlertDialog>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>
                <div class="flex justify-end">
                    <Pagination
                        :links="types.links"
                        :prev="types.prev_page_url"
                        :next="types.next_page_url"
                        :current="types.current_page"
                        :last="types.last_page"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AlertDialog from '@/components/AlertDialog.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import Icon from '@/components/Icon.vue';
import Pagination from '@/components/Pagination.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type Type } from '@/types';
import { Head, Link, router, usePage } from '@inertiajs/vue3';

import iziToast from 'izitoast';

import 'izitoast/dist/css/iziToast.min.css';
import { ref } from 'vue';

usePage();

defineProps<{
    types: Type[];
    errors: object;
}>();

const search = ref(new URL(window.location.href).searchParams.get('q'));

const handleSearch = () => {
    router.get(
        route('admin.products.types.index'),
        {
            q: search.value !== null ? search.value : '',
        },
        {
            preserveState: true,
        },
    );
};

const info = { title: 'Type Management', description: 'Manage your Types' };

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin',
        href: '#',
    },
    {
        title: 'Products',
        href: '#',
    },
    {
        title: 'Types',
        href: '/admin/products/types',
    },
];

const handleConfirmDelete = (value: Type) => {
    router.delete(route('admin.products.types.destroy', value.id), {
        preserveState: true,
        onSuccess: () => {
            iziToast.show({
                title: 'Success',
                theme: 'dark',
                icon: 'fa-solid fa-check',
                progressBarColor: 'rgb(0, 255, 184)',
                message: `Type ${value.name} deleted successfully.`,
            });
        },
    });
};
</script>

<style scoped></style>
