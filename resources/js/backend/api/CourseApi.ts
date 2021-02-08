import HttpClient from "@backend/api/HttpClient";
import { Course, CreateCourse } from "@backend/api/interfaces/Course";

export class CourseApi extends HttpClient {
  public create = (data: CreateCourse) => this.post<Course>('/courses', data);
}

export const courseApi = new CourseApi();
