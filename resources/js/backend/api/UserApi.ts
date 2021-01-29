import HttpClient from '@backend/api/HttpClient';
import User from "@backend/api/interfaces/User";

export default class UserApi extends HttpClient {
  public getCurrentUser = () => this.get<User>('/user');
}
