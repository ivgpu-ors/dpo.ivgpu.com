export interface Employee {
  id: number;
  full_name: string;
  post: string;
  created_at: Date;
  updated_at: Date;
}

export interface CreateParams {
  full_name: string;
  post: string;
}
