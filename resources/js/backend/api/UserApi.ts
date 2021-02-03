import HttpClient from '@backend/api/HttpClient';
import User from "@backend/api/interfaces/User";

export class UserApi extends HttpClient {
  public getCurrentUser = () => this.get<User>('/user');
}

export const userApi = new UserApi();
