import HttpClient from "@backend/api/HttpClient";
import { Course, CourseView, CreateCourse } from "@backend/api/interfaces/Course";

export class CourseApi extends HttpClient {
  public all = () => this.get<CourseView[]>('/courses');
  public create = (data: CreateCourse) => this.post<Course>('/courses', data);
}

export const courseApi = new CourseApi();
