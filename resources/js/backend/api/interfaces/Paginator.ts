export interface PaginatorLink {
  url?: string;
  label: string;
  active: boolean;
}

export interface Paginator<T> {
  current_page: number;
  path: string;
  first_page_url: string;
  prev_page_url?: string;
  next_page_url?: string;
  last_page_url: string;
  from: number;
  to: number;
  total: number;
  per_page: number;
  last_page: number;
  links: PaginatorLink[];
  data: T[];
}
