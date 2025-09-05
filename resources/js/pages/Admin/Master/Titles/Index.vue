<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head :title="info.title" />
        <div class="p-4">
            <div class="flex h-full flex-col space-y-6">
                <HeadingSmall :title="info.title" :description="info.description" />
                <div class="h-[29rem]">
                    <form @submit.prevent="handleSearch">
                        <div class="mb-4 flex w-full items-center">
                            <Input v-model="search" class="rounded-r-none" id="search" type="text" placeholder="Search" />
                            <Button class="rounded-l-none" type="submit"> <Icon code="heroicons:magnifying-glass-16-solid" /> Cari </Button>
                        </div>
                    </form>
                    <Table>
                        <!-- <TableCaption>A list of your recent invoices.</TableCaption> -->
                        <TableHeader>
                            <TableRow>
                                <TableHead class="w-[100px]"> Name </TableHead>
                                <TableHead class="w-[100px]"> Gender </TableHead>
                                <TableHead class="w-[100px]"> Description </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="(value, id) in titles.data" :key="id">
                                <TableCell class="font-medium">
                                    {{ value.name }}
                                </TableCell>
                                <TableCell class="capitalize">
                                    {{ value.gender }}
                                </TableCell>
                                <TableCell>
                                    {{ value.description }}
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>
                <div class="flex justify-end">
                    <Pagination
                        :links="titles.links"
                        :prev="titles.prev_page_url"
                        :next="titles.next_page_url"
                        :current="titles.current_page"
                        :last="titles.last_page"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import HeadingSmall from '@/components/HeadingSmall.vue';
import Icon from '@/components/Icon.vue';
import Pagination from '@/components/Pagination.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type Title } from '@/types';
import { Head, router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage();

const props = defineProps<{
    titles: Title[];
    errors: object;
}>();

const search = ref(new URL(window.location.href).searchParams.get('q'));

const handleSearch = () => {
    router.get(
        route('admin.master.titles.index'),
        {
            q: search.value !== null ? search.value : '',
        },
        {
            preserveState: true,
        },
    );
};

const info = { title: 'Titles', description: 'Manage Master Titles' };

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin',
        href: '#',
    },
    {
        title: 'Master',
        href: '#',
    },
    {
        title: 'Titles',
        href: '/admin/master/titles',
    },
];
</script>

<style scoped></style>
