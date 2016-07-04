export function buildBasePath(path){
  return window.location.protocol + "//" + window.location.host + path
}

export function isMobile(mobile){
  return /^1[3|4|5|8]\d{9}$/.test(mobile)
}