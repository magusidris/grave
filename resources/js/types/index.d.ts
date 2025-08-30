import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
    items?: {
        title: string;
        href: string;
        icon?: LucideIcon;
        isActive?: boolean;
    }[];
}

export interface ProvinceResource {
    id: number;
    name: string;
    created_at: DateTime;
    updated_at: DateTime;
}

export interface CityResource {
    id: number;
    province_id: number;
    province: string;
    name: string;
    created_at: DateTime;
    updated_at: DateTime;
}

export interface SubdistrictResource {
    id: number;
    city_id: number;
    city: string;
    name: string;
    created_at: DateTime;
    updated_at: DateTime;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
};

export type PaginationLink = {
    url: string | null;
    label: string;
    active: boolean;
};

export interface Title {
    id: number;
    name: string;
    gender: string;
    description: string;
    created_at: string;
    updated_at: string;
}

export interface Identity {
    id: number;
    name: string;
    description: string;
    created_at: string;
    updated_at: string;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;
