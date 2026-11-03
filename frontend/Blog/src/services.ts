import type { LoginPayload, RegisterPayload } from "./types";
const BASE_URL = "http://localhost/api/v1"

export const authService = {
  async register(userPayload: RegisterPayload) {
    const response = await fetch(`${BASE_URL}/auth/register`, {
      method: "POST",
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        name: userPayload.name,
        email: userPayload.email,
        password: userPayload.password,
        password_confirmation: userPayload.passwordConfirmation,
      })
    })

    if (!response.ok) {
      const errorMessage = `Ошибка регистрации ${response.status}`
      throw new Error(errorMessage)
    }
    
    const data = await response.json()
    console.log(data)
    if (!data?.token) {
      throw new Error("Сервер не вернул токен!")
    }

    sessionStorage.setItem('token', data.token)
    sessionStorage.setItem('token_type', data.token_type)
    return data
  },

  async login(userPayload: LoginPayload) {
    const response = await fetch(`${BASE_URL}/auth/login`, {
      method: "POST",
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        email: userPayload.email,
        password: userPayload.password,
      })
    })
    if (!response.ok) {
      const errorMessage = `Ошибка авторизации ${response.status}`
      throw new Error(errorMessage)
    }
    
    const data = await response.json()
    if (!data?.token) {
      throw new Error("Сервер не вернул токен!")
    }

    sessionStorage.setItem('token_type', data.token_type)
    sessionStorage.setItem('token', data.token)
    return data
  }
}

export const TokenService = {
  getAuthHeader() {
    const tokenType = sessionStorage.getItem("token_type")
    const token = sessionStorage.getItem("token")
    return (token && tokenType) 
      ? `${tokenType} ${token}`
      : null
  },

  isAuthorized() {
    return !!(sessionStorage.getItem('token'))
  },

  clear() {
    sessionStorage.removeItem("token_type")
    sessionStorage.removeItem("token")
  }
} 

export const postService = {
  async getPosts(params?: { cursor?: string }) {
    const queryParams = new URLSearchParams()
    if (params) {
      if (params.cursor) {
        queryParams.append('cursor', params.cursor)
      }
    }

    const queryString = queryParams.toString()

    const response = await fetch(`http://localhost/api/v1/post/main?${queryString}`, {
      method: "GET",
      headers: {
        'Authorization': `${TokenService.getAuthHeader()}`
      },
    })

    if (!response.ok) {
      const errorMessage = `Ошибка авторизации ${response.status}`
      throw new Error(errorMessage)
    }
    
    const data = await response.json()
    return data
  }
}