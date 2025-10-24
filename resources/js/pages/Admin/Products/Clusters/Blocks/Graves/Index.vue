<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head :title="info.title" />
        <div class="p-4">
            <div class="flex h-full flex-col space-y-6">
                <HeadingSmall :title="info.title" :description="info.description" />
                <div class="h-[29rem]">
                    <form @submit.prevent="addGrave">
                        <div class="mb-7 flex flex-col space-y-3 border px-5 py-5">
                            <div class="text-lg font-bold">Tambahkan Makam</div>
                            <div class="flex w-[60%] space-x-3">
                                <div class="w-full">
                                    <div class="flex w-full">
                                        <div>
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
                                                class="inset-y-0 start-0 w-40"
                                                v-model="form.type"
                                                :items="types"
                                                placeholder="Pilih tipe makam"
                                            />
                                            <InputError class="mt-2" :message="form.errors.type" />
                                        </div>
                                    </div>
                                </div>
                                <Button type="submit" class="btn join-item btn-sm md:btn-md bg-green-500 text-white hover:bg-green-600">
                                    <Icon code="line-md:document-code-twotone" size="16" />Generate
                                </Button>
                            </div>
                        </div>
                    </form>
                    <form @submit.prevent="handleSearch">
                        <div class="mb-4 flex w-full items-center">
                            <Dialog>
                                <template #trigger>
                                    <Button class="h-10 w-27 cursor-pointer rounded-r-none bg-teal-600 uppercase hover:bg-teal-700"
                                        ><Icon code="fa6-solid:plus" /> New
                                    </Button>
                                </template>
                                <template #header>
                                    <DialogTitle>Add Grave</DialogTitle>
                                    <DialogDescription> Fill in the details below to add a new grave. </DialogDescription>
                                </template>
                                <template #default>
                                    <div class="grid gap-4 lg:grid-cols-2">
                                        <div class="grid w-full items-center gap-1.5">
                                            <Label for="cluster">Cluster</Label>
                                            <SimpleCombobox
                                                class="inset-y-0 start-0 w-full"
                                                title="Cluster"
                                                @change="onTypeChange"
                                                v-model="form.cluster"
                                                :datas="clusters"
                                                placeholder="Select Cluster"
                                            />
                                            <InputError class="mt-2" :message="form.errors.cluster" />
                                        </div>
                                        <div class="grid w-full items-center gap-1.5">
                                            <Label for="block">Block</Label>
                                            <SimpleCombobox
                                                class="inset-y-0 start-0 w-full"
                                                title="Block"
                                                @change="getCountOfGraves"
                                                v-model="form.block"
                                                :datas="blocks"
                                                placeholder="Select Block"
                                            />
                                            <InputError class="mt-2" :message="form.errors.block" />
                                        </div>
                                    </div>
                                    <div class="grid gap-4 lg:grid-cols-2">
                                        <div class="grid w-full items-center gap-1.5">
                                            <Label for="type">Type</Label>
                                            <SimpleCombobox
                                                class="inset-y-0 start-0 w-full"
                                                title="Type"
                                                @change="onTypeChange"
                                                v-model="form.type"
                                                :datas="types"
                                                placeholder="Select Type"
                                            />
                                            <InputError class="mt-2" :message="form.errors.type" />
                                        </div>
                                        <div class="grid w-full items-center gap-1.5">
                                            <Label for="number">Number</Label>
                                            <div class="grid grid-cols-2 gap-2">
                                                <div>
                                                    <Input
                                                        id="from"
                                                        ref="from"
                                                        v-model="form.from"
                                                        type="number"
                                                        class="mt-1 block w-full"
                                                        placeholder="From"
                                                    />
                                                    <InputError class="mt-2" :message="form.errors.from" />
                                                </div>
                                                <div>
                                                    <Input
                                                        id="to"
                                                        ref="to"
                                                        v-model="form.to"
                                                        type="number"
                                                        class="mt-1 block w-full"
                                                        placeholder="To"
                                                    />
                                                    <InputError class="mt-2" :message="form.errors.to" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid w-full items-center gap-1.5">
                                        <Label for="code">Code</Label>
                                        <Input id="code" v-model="form.code" type="text" class="mt-1 block w-full" placeholder="Code" disabled />
                                        <InputError class="mt-2" :message="form.errors.code" />
                                    </div>
                                    <label class="flex items-center">
                                        <Checkbox name="is_available" v-model:checked="form.is_available" />
                                        <span class="ml-2 text-sm text-gray-600 select-none">Is Available</span>
                                    </label>
                                    <label class="flex items-center">
                                        <Checkbox name="is_occupied" v-model:checked="form.is_occupied" />
                                        <span class="ml-2 text-sm text-gray-600 select-none">Is Occupied</span>
                                    </label>
                                    <label class="flex items-center">
                                        <Checkbox name="is_fully_paid" v-model:checked="form.is_fully_paid" />
                                        <span class="ml-2 text-sm text-gray-600 select-none">Is Fully Paid</span>
                                    </label>
                                </template>
                                <template #footer>
                                    <form @submit.prevent="onSubmit"><Button type="submit"> Generate </Button></form>
                                </template>
                            </Dialog>
                            <Input v-model="search" class="h-10 rounded-none" id="search" type="text" placeholder="Search" />
                            <Button class="h-10 w-27 cursor-pointer rounded-l-none bg-teal-600 uppercase hover:bg-teal-700" type="submit">
                                <Icon code="heroicons:magnifying-glass-16-solid" /> Cari
                            </Button>
                        </div>
                    </form>
                    <div class="mx-auto w-full">
                        <h1 class="mb-2 text-center text-4xl font-bold text-gray-900">Dashboard Kavling Pemakaman</h1>
                        <p class="mb-8 text-center text-gray-600">Visualisasi ketersediaan kavling secara real-time.</p>

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
                            <div class="flex items-center">
                                <div class="mr-2 h-5 w-5 rounded-sm bg-gray-700"></div>
                                <span class="text-sm font-medium">Ditempati</span>
                            </div>
                        </div>

                        <div class="flex w-full pb-6">
                            <!-- DAFTAR CLUSTER -->
                            <div class="w-full space-y-3 rounded-xl">
                                <!-- CLUSTER 1: BOUGENVILLE -->
                                <div class="w-full flex-shrink-0 rounded-xl bg-white" id="cluster-bougenville">
                                    <div class="w-auto flex-shrink-0 rounded-lg border bg-gray-50 p-6">
                                        <h3 class="mb-4 text-center text-xl font-semibold">Blok A</h3>
                                        <div class="grid grid-cols-10 gap-2">
                                            <!-- 20 Kavling (Grave) -->
                                            <div
                                                class="flex h-[2rem] w-[1.2rem] items-center justify-center rounded bg-green-500 text-xs font-bold text-white"
                                                title="A-1"
                                            >
                                                1
                                            </div>
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
import Checkbox from '@/components/Checkbox.vue';
import Combobox from '@/components/Combobox.vue';
import Dialog from '@/components/Dialog.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import Icon from '@/components/Icon.vue';
import InputError from '@/components/InputError.vue';
import SimpleCombobox from '@/components/SimpleCombobox.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import AppLayout from '@/layouts/AppLayout.vue';
import { type Block, type BreadcrumbItem, type Cluster, type Grave, type Type } from '@/types';
import { Head, router, useForm, usePage } from '@inertiajs/vue3';

import { Label } from '@/components/ui/label';

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

const info = { title: `Cluster ${props.cluster.name} Block ${props.block.name} Grave Management`, description: 'Manage your Graves' };

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
        title: 'Graves',
        href: '/admin/products/graves',
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
