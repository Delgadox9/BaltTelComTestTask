import type { Category } from '@/models/Category'

export interface Product {
    id: number | null,
    name: string | null,
    description: string | null,
    price: number | null,
    category: Category | null
}
