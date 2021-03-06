import axios, { AxiosInstance } from "axios";

export default abstract class HttpClient {
  protected readonly instance: AxiosInstance;

  public constructor() {
    const baseURL = '/api';
    this.instance = axios.create({ baseURL, withCredentials: true });
  }

  protected get = async <T>(url: string, query: object = {}): Promise<T> =>
    (await this.instance.get<T>(url, { params: query })).data;

  protected post = async <T>(url: string, params: object = {}): Promise<T> =>
    (await this.instance.post<T>(url, params)).data;

  protected postFiles = async <T>(url: string, formData: FormData): Promise<T> =>
    (await this.instance.post<T>(url, formData, { headers: { 'Content-Type': 'multipart/form-data' } })).data;

  protected patch = async <T>(url: string, params: object = {}): Promise<T> =>
    (await this.instance.patch<T>(url, params)).data;
}
