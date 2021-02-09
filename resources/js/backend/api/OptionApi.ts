import HttpClient from "@backend/api/HttpClient";
import { Option } from "@backend/api/interfaces/Option";

export class OptionApi extends HttpClient {
  public all = () => this.get<Option[]>('/options');
  public create = (data: Option) => this.post<Option>('/options', data);
}

export const optionApi = new OptionApi();
