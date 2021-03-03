import { Option } from "@backend/api/interfaces/Option";
import { File } from "@backend/api/interfaces/File";

export interface Course {
  id: number;
  name: string;
  content_url: string,
  image_id?: Number;
  image?: File;
  enabled: boolean;
  start?: Date;
  end?: Date;
  duration: string;
  education_time: string;
  description: string;
  program: string;
  conditions?: string;
  target_audience?: string;
  impl_form: string;
  leader_id?: number;
  teachers_ids: Number[];
  options?: { option: Option, price: Number }[];
  deleted_at?: Date;
  created_at?: Date;
  updated_at?: Date;
}

export interface CourseView {
  id: number;
  name: string;
  enabled: boolean;
}
