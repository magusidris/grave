<script setup lang="ts">
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { LayoutGrid, Target } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
        icon: LayoutGrid,
    },
];

const navItem2: NavItem[] = [
    {
        title: 'Products',
        href: '/products',
        icon: LayoutGrid,
        isActive: true,
        items: [
            {
                title: 'Graves',
                href: '/admin/products/clusters',
                icon: Target,
            },
            {
                title: 'Types',
                href: '/admin/products/types',
                icon: Target,
            },
        ],
    },
];

const navItem3: NavItem[] = [
    {
        title: 'Master Data',
        href: '/master',
        icon: LayoutGrid,
        isActive: true,
        items: [
            {
                title: 'Provinces',
                href: '/admin/master/provinces',
                icon: Target,
            },
            {
                title: 'Cities',
                href: '/admin/master/cities',
                icon: Target,
            },
            {
                title: 'Subdistricts',
                href: '/admin/master/subdistricts',
                icon: Target,
            },
            {
                title: 'Titles',
                href: '/admin/master/titles',
                icon: Target,
            },
            {
                title: 'Identities',
                href: '/admin/master/identities',
                icon: Target,
            },
            {
                title: 'Relationships',
                href: '/admin/master/relationships',
                icon: Target,
            },
            {
                title: 'Payment Methods',
                href: '/admin/master/payments',
                icon: Target,
            },
        ],
    },
];

const navItem4: NavItem[] = [
    {
        title: 'User Management',
        href: '/management',
        icon: LayoutGrid,
        isActive: true,
        items: [
            {
                title: 'Roles',
                href: '/admin/management/roles',
                icon: Target,
            },
            {
                title: 'Permissions',
                href: '/admin/management/permissions',
                icon: Target,
            },
            {
                title: 'Users',
                href: '/admin/management/users',
                icon: Target,
            },
        ],
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('admin.dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain group-label="Test" :items="mainNavItems" />
            <NavMain collapsible :items="navItem2" />
            <NavMain collapsible :items="navItem3" />
            <NavMain collapsible :items="navItem4" />
        </SidebarContent>

        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
