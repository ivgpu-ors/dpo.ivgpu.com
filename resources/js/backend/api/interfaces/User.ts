export default interface User {
  id: string;
  last_name: string;
  first_name: string;
  middle_name?: string;
  photo?: string;
  phone?: string;
  email: string;
  email_verified_at?: Date;
  roles: string[];
  created_at: Date;
  updated_at: Date;
}
