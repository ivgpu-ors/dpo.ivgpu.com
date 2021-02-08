import HttpClient from "@backend/api/HttpClient";
import { Course, CourseView } from "@backend/api/interfaces/Course";

export class CourseApi extends HttpClient {
  public all = () => this.get<CourseView[]>('/courses');
  public create = (data: Course) => this.post<Course>('/courses', data);
  public update = (id: Number, data: Course) => this.patch<Course>('/courses/' + id, data);
  public toggle = (id: number) => this.post<boolean>(`/courses/${id}/toggle`);
  public load = (id: Number) => this.get<Course>(`/courses/${id}`);
}

export const courseApi = new CourseApi();
