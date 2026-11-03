export interface RegisterPayload {
  name: string,
  email: string,
  password: string,
  passwordConfirmation: string,
}

export interface LoginPayload {
  email: string,
  password: string,
}

export interface Post {
  id: string | number,
  user_id: string | number,
  author_post: string,
  title: string,
  excerpt: string,
  body: string,
  categories: string,
  created_at: string,
  updated_at: string
}