import { post, $delete, put } from "./http";

// 登录
export const login = data => post('auth/login', data);
