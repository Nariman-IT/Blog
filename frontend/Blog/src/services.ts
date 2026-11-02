import type { RegisterPayload } from "./types";

export const authService = {
  async register(userPayload: RegisterPayload) {
    const response = await fetch("http://localhost/api/v1/auth/register", {
      method: "POST",
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(userPayload)
    })

    if (!response.ok) {
      const errorMessage = `Ошибка регистрации ${response.status}`
      throw new Error(errorMessage)
    }
    
    console.log(response)
    const data = await response.json()
    console.log(data)
    if (!data?.token) {
      throw new Error("Сервер не вернул токен!")
    }

    sessionStorage.setItem('token', data.token)
    return data
  }
}