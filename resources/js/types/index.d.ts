export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
    is_admin: boolean;
}

export interface Announcement {
    id: number;
    title: string;
    body: string;
    slug: string;
    posted: string;
    author: string;
    viewed?: boolean;
}

export interface PaginationLink {
    active: boolean;
    label?: string;
    url?: string;
}

export interface PaginatedAnnouncements {
    current_page: number;
    data: Announcement[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: PaginationLink[];
    next_page_url?: string;
    path: string;
    per_page: number;
    prev_page_url?: string;
    to: number;
    total: number;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
    unread_notifications: object[];
};
