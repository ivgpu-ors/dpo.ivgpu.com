export default interface Client {
  id: string;
  last_name: string;
  first_name: string;
  middle_name?: string;
  photo?: string;
  phone?: string;
  email: string;
  orders_all: number;
  orders_paid: number;
  orders_sum: number;
}
