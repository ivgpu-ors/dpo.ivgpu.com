export interface Course {
  id: number;
  name: string;
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
  created_at: Date;
  updated_at: Date;
}

export interface CourseView {
  id?: number;
  name?: string;
  enabled?: boolean;
  start?: Date;
  end?: Date;
  duration?: string;
  education_time?: string;
  description?: string;
  program?: string;
  conditions?: string;
  target_audience?: string;
  impl_form?: string;
  leader_id?: number;
  created_at?: Date;
  updated_at?: Date;
}

export interface CreateCourse {
  name: string;
  enabled?: boolean;
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
  teacher_ids?: number[];
}
