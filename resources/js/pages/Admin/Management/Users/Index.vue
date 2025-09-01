<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Dashboard" />
        <div class="p-4">
            <div class="flex h-full flex-col space-y-6">
                <HeadingSmall title="Role Management" description="Manage your roles" />
                <div class="h-[29rem]">
                    <form @submit.prevent="handleSearch">
                        <div class="mb-4 flex w-full items-center">
                            <Button class="h-10 w-27 rounded-r-none bg-teal-600 uppercase hover:bg-teal-700"
                                ><Icon code="fa6-solid:plus" /> New
                            </Button>
                            <Input v-model="search" class="h-10 rounded-none" id="search" type="text" placeholder="Search" />
                            <Button class="h-10 w-27 rounded-l-none bg-teal-600 uppercase hover:bg-teal-700" type="submit">
                                <Icon code="heroicons:magnifying-glass-16-solid" /> Cari
                            </Button>
                        </div>
                    </form>
                    <Table class="table-fixed">
                        <!-- <TableCaption>A list of your recent invoices.</TableCaption> -->
                        <TableHeader>
                            <TableRow>
                                <TableHead class="w-[25em]"> Name </TableHead>
                                <TableHead> Permissions </TableHead>
                                <TableHead class="w-[20em]"> Actions </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="(role, id) in roles.data" :key="id">
                                <TableCell class="content-start text-start text-base">
                                    {{ role.name }}
                                </TableCell>
                                <TableCell class="flex flex-wrap gap-2 px-8">
                                    <Badge v-for="(value, id) in role.permissions" :key="id">
                                        {{ value.name }}
                                    </Badge>
                                </TableCell>
                                <TableCell class="content-start text-center">
                                    <Button class="mr-2 bg-green-600 hover:bg-green-700" size="sm"><Icon code="fa6-solid:pencil" /> Edit </Button>
                                    <Button class="bg-red-600 hover:bg-red-700" size="sm"><Icon code="fa6-solid:trash" /> Delete </Button>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>
                <div class="flex justify-end">
                    <Pagination
                        :links="roles.links"
                        :prev="roles.prev_page_url"
                        :next="roles.next_page_url"
                        :current="roles.current_page"
                        :last="roles.last_page"
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
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';

import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type Identity } from '@/types';
import { Head, router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage();

const props = defineProps<{
    roles: Identity[];
    errors: Object;
}>();

const search = ref(new URL(document.location).searchParams.get('q'));

const handleSearch = () => {
    router.get(
        route('admin.management.roles.index'),
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
        title: 'User Management',
        href: '#',
    },
    {
        title: 'Role Users',
        href: '/admin/management/roles',
    },
];
</script>

<style scoped></style>
