import request from '@/utils/request'

// 登录方法
export function login(data) {
  return request({
    'url': '/ecmsapi/index.php?mod=user&act=login',
    headers: {
      isToken: false
    },
    'method': 'post',
    'data': data
  })
}

export function register(data) {
  return request({
    'url': '/ecmsapi/index.php?mod=user&act=register',
    headers: {
      isToken: false
    },
    'method': 'post',
    'data': data
  })
}

// 获取用户详细信息
export function getInfo() {
  return request({
    'url': '/ecmsapi/index.php?mod=user&act=info',
    'method': 'get'
  })
}

export function getInfoByUser(data) {
  return request({
    'url': '/ecmsapi/index.php?mod=user&act=userinfo',
    'method': 'get',
	'data':data
  })
}

// 退出方法
export function logout() {
  return request({
    'url': '/ecmsapi/index.php?mod=user&act=logout',
    'method': 'post'
  })
}

// 获取验证码
export function getCodeImg() {
  return request({
    'url': '/captchaImage',
    headers: {
      isToken: false
    },
    method: 'get',
    timeout: 20000
  })
}
