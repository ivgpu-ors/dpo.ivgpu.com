import axios, { AxiosInstance } from "axios";

export default abstract class HttpClient {
  protected readonly instance: AxiosInstance;

  public constructor() {
    const baseURL = '/api';
    this.instance = axios.create({ baseURL, withCredentials: true });
  }

  protected get = async <T>(url: string): Promise<T> => (await this.instance.get<T>(url)).data;
}
