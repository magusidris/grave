<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Dashboard" />
        <div class="p-4">
            <div class="flex h-full flex-col space-y-6">
                <HeadingSmall title="Cities" description="Manage your cities" />
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
                                <TableHead class="w-[100px]"> Province </TableHead>
                                <TableHead class="w-[100px]"> City </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="(city, id) in cities.data" :key="id">
                                <TableCell class="font-medium">
                                    {{ city.province }}
                                </TableCell>
                                <TableCell class="font-medium">
                                    {{ city.name }}
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>
                <div class="flex justify-end">
                    <Pagination
                        :links="cities.links"
                        :prev="cities.prev_page_url"
                        :next="cities.next_page_url"
                        :current="cities.current_page"
                        :last="cities.last_page"
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
import { type BreadcrumbItem, type City } from '@/types';
import { Head, router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage();

const props = defineProps<{
    cities: City[];
    errors: Object;
}>();

const search = ref(new URL(document.location).searchParams.get('q'));

const handleSearch = () => {
    router.get(
        route('admin.master.city.index'),
        {
            q: search.value !== null ? search.value : '',
        },
        {
            preserveState: true,
        },
    );
};

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
        title: 'Cities',
        href: '/admin/master/cities',
    },
];
</script>

<style scoped></style>
