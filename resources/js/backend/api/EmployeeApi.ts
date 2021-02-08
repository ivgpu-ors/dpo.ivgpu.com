import HttpClient from '@backend/api/HttpClient';
import { Employee, CreateParams } from "@backend/api/interfaces/Employee";

export class EmployeeApi extends HttpClient {
  public getAll = () => this.get<Employee[]>('/employees');
  public suggest = (search: string) => this.get<Employee[]>('/employees/suggest', { s: search });
  public byIds = (ids: Number[]) => this.get<Employee[]>('/employees/get', { ids: ids });
  public create = (data: CreateParams) => this.post<Employee>('/employees', data);
}

export const employeeApi = new EmployeeApi();
