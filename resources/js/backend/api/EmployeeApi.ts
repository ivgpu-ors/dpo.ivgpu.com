import HttpClient from '@backend/api/HttpClient';
import Employee from "@backend/api/interfaces/Employee";

export class EmployeeApi extends HttpClient {
  public getAll = () => this.get<Employee[]>('/employees');
  public suggest = (search: string) => this.get<Employee[]>('/employees/suggest', { s: search });
}

export const employeeApi = new EmployeeApi();
