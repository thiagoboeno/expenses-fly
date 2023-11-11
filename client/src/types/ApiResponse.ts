interface ApiResponseLinks {
  first: string | null;
  last: string | null;
  prev: string | null,
  next: string | null;
}

interface ApiMetaLinks {
  url: string | null;
  label: string | null;
  active: boolean,
}

export interface ApiResponseMeta {
  current_page: number,
  from: number,
  last_page: number,
  links: ApiMetaLinks[],
  path: string;
  per_page: number;
  to: number;
  total: number;
}

export interface ApiResponse<T> {
  data: T;
  links?: ApiResponseLinks;
  meta?: ApiResponseMeta;
  success: boolean;
}
