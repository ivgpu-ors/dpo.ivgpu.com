import HttpClient from '@backend/api/HttpClient';
import { Paginator } from "@backend/api/interfaces/Paginator";
import Client from "@backend/api/interfaces/Client";

export class ClientApi extends HttpClient {
  public getClients = (page: number = 1) => this.get<Paginator<Client>>(`/clients?page=${page}`);
}

export const clientApi = new ClientApi();
