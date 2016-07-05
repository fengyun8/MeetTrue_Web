export function buildBasePath(path){
  return window.location.protocol + "//" + window.location.host + path
}

export function isMobile(mobile){
  return /^1[3|4|5|7|8]\d{9}$/.test(mobile)
}

export function isEmail(email){
  return /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/.test(email)
}

export function isRightPwd(pwd) {
  return /^\S{6,12}$/.test(pwd)
}