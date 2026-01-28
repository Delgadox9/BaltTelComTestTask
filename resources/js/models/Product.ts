import type { Category } from '@/models/Category'

export interface Product {
    id: number,
    name: string,
    description: string,
    price: number,
    category: Category
}
