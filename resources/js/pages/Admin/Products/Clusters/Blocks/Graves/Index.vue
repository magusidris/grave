<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head :title="info.title" />
        <div class="p-4">
            <div class="flex h-full flex-col space-y-6">
                <HeadingSmall class="capitalize" :title="info.title" :description="info.description" />
                <div class="h-[29rem]">
                    <form @submit.prevent="addGrave">
                        <div class="mb-7 flex flex-col space-y-3 border px-5 py-5">
                            <div class="text-lg font-bold">Tambahkan Makam</div>
                            <div class="flex space-x-3 2xl:w-[50%]">
                                <div class="w-full">
                                    <div class="flex w-full flex-col gap-x-3 lg:flex-row">
                                        <div class="w-full">
                                            <Input
                                                type="number"
                                                min="1"
                                                v-model="form.amount"
                                                class=""
                                                placeholder="Jumlah makam yang akan ditambahkan"
                                            />
                                            <InputError class="mt-2" :message="form.errors.amount" />
                                        </div>
                                        <div>
                                            <Combobox
                                                class="inset-y-0 start-0 w-full 2xl:w-50"
                                                v-model="form.type"
                                                :items="types"
                                                placeholder="Pilih tipe makam"
                                            />
                                            <InputError class="mt-2" :message="form.errors.type" />
                                        </div>
                                        <Button type="submit" class="btn join-item btn-sm md:btn-md bg-green-500 text-white hover:bg-green-600">
                                            <Icon code="line-md:document-code-twotone" size="16" />Generate
                                        </Button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="mx-auto w-full">
                        <h1 class="mb-2 text-center text-lg font-bold text-gray-900 capitalize 2xl:text-4xl">
                            Dashboard Blok {{ props.block.name }} Kluster {{ props.cluster.name }}
                        </h1>
                        <p class="mb-8 text-center text-sm text-gray-600 2xl:text-lg">Visualisasi ketersediaan kavling makam secara real-time.</p>

                        <!-- KARTU LEGENDA -->
                        <div class="mb-10 flex items-center justify-center space-x-6 rounded-lg bg-white p-4 shadow-md">
                            <div class="flex items-center">
                                <div class="mr-2 h-5 w-5 rounded-sm bg-green-500"></div>
                                <span class="text-sm font-medium">Tersedia</span>
                            </div>
                            <div class="flex items-center">
                                <div class="mr-2 h-5 w-5 rounded-sm bg-yellow-500"></div>
                                <span class="text-sm font-medium">Dipesan</span>
                            </div>
                            <div class="flex items-center">
                                <div class="mr-2 h-5 w-5 rounded-sm bg-red-500"></div>
                                <span class="text-sm font-medium">Terjual</span>
                            </div>
                        </div>

                        <div class="flex w-full pb-6">
                            <!-- DAFTAR CLUSTER -->
                            <div class="w-full space-y-3 rounded-xl">
                                <!-- CLUSTER 1: BOUGENVILLE -->
                                <div class="w-full flex-shrink-0 rounded-xl bg-white" id="cluster-bougenville">
                                    <div class="w-auto flex-shrink-0 rounded-lg border bg-gray-50 p-6">
                                        <div class="relative grid min-h-[20rem] grid-cols-4 gap-y-5 lg:grid-cols-8 2xl:grid-cols-10">
                                            <template v-if="graves.length > 0">
                                                <div
                                                    v-for="value in graves"
                                                    :key="value.id"
                                                    class="group relative flex overflow-hidden rounded-xl shadow-lg"
                                                    :class="[
                                                        value.type_id == 1 ? 'h-[7rem] w-[4rem]' : 'h-[7rem] w-[4.3rem]',
                                                        value.status == 'available'
                                                            ? 'bg-green-500'
                                                            : value.status == 'reserved'
                                                              ? 'bg-yellow-500'
                                                              : 'bg-red-500',
                                                    ]"
                                                >
                                                    <div
                                                        class="h-full w-[10rem] border transition duration-300 ease-in-out group-hover:scale-105"
                                                    ></div>
                                                    <div
                                                        class="absolute right-0 bottom-0 left-0 flex h-9 items-center justify-center bg-black/20 text-white transition-all duration-500 ease-out group-hover:h-full"
                                                    >
                                                        <div class="text-sm font-black">
                                                            {{ value.type_id == 1 ? `M - ${value.sequence}` : `L - ${value.sequence}` }}
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="absolute inset-0 opacity-0 transition-opacity duration-300 ease-in group-hover:opacity-100"
                                                    ></div>
                                                </div>
                                            </template>
                                            <template v-else>
                                                <div class="absolute inset-0 flex items-center justify-center text-gray-500">
                                                    Belum ada data pada kluster blok ini
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import Combobox from '@/components/Combobox.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import Icon from '@/components/Icon.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import AppLayout from '@/layouts/AppLayout.vue';
import { type Block, type BreadcrumbItem, type Cluster, type Grave, type Type } from '@/types';
import { Head, router, useForm, usePage } from '@inertiajs/vue3';

import iziToast from 'izitoast';

import 'izitoast/dist/css/iziToast.min.css';
import { ref } from 'vue';

usePage();

const props = defineProps<{
    cluster: Cluster[];
    block: Block[];
    types: Type[];
    graves: Grave[];
    errors: object;
}>();

const search = ref(new URL(window.location.href).searchParams.get('q'));

const handleSearch = () => {
    router.get(
        route('admin.products.graves.index'),
        {
            q: search.value !== null ? search.value : '',
        },
        {
            preserveState: true,
        },
    );
};

const info = { title: `Block ${props.block.name} Cluster ${props.cluster.name} Grave Management`, description: 'Manage your Graves' };

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin',
        href: '/admin/dashboard',
    },
    {
        title: 'Products',
        href: '#',
    },
    {
        title: 'Clusters',
        href: `/admin/products/clusters`,
    },
    {
        title: 'Blocks',
        href: `/admin/products/clusters/${props.cluster.id}/blocks`,
    },
    {
        title: 'Graves',
        href: `/admin/products/clusters/${props.cluster.id}/blocks/${props.block.id}/graves`,
    },
];

const handleConfirmDelete = (value: Block) => {
    router.delete(route('admin.products.graves.destroy', value.id), {
        preserveState: true,
        onSuccess: () => {
            iziToast.show({
                title: 'Success',
                theme: 'dark',
                icon: 'fa-solid fa-check',
                progressBarColor: 'rgb(0, 255, 184)',
                message: `Grave ${value.name} deleted successfully.`,
            });
        },
    });
};

const form = useForm({
    amount: '',
    type: '',
});

const addGrave = () => {
    form.post(`/admin/products/clusters/${props.cluster.id}/blocks/${props.block.id}/graves`, {
        onSuccess: () => form.reset(),
    });
};
</script>

<style scoped></style>
