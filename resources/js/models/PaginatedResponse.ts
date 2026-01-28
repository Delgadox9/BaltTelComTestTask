import {Meta} from "@/models/Meta";

export interface PaginatedResponse<T> {
    data: T[]
    meta: Meta
}
