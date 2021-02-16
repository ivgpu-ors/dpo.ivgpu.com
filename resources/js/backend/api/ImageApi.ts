import HttpClient from "@backend/api/HttpClient";
import { File } from "@backend/api/interfaces/File";

export class ImageApi extends HttpClient {
  public upload = async (files: FileList) => {
    const data = new FormData();

    for (let i = 0; i < files.length; i++) {
      data.append('file[]', files[i])
    }

    return this.postFiles<File[]>('images', data);
  }
}

export const imageApi = new ImageApi();
