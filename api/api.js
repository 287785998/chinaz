import request from '@/utils/request'
//系统信息
export function getSystemInfo(data) {
  return request({
    'url': '/ecmsapi/index.php?mod=system&act=systeminfo',
    headers: {
      isToken: false
    },
    'method': 'get',
    'data': data
  })
}
//新闻列表
export function getNewsList(data) {
  return request({
    'url': '/ecmsapi/index.php?mod=news&act=list',
    headers: {
      isToken: false
    },
    'method': 'get',
    'data': data
  })
}

//视频列表
export function getMovieList(data) {
  return request({
    'url': '/ecmsapi/index.php?mod=movie&act=list',
    headers: {
      isToken: false
    },
    'method': 'get',
    'data': data
  })
}

//新闻详情
export function getNewsDetail(data) {
  return request({
    'url': '/ecmsapi/index.php?mod=news&act=details',
    headers: {
      isToken: false
    },
    'method': 'get',
    'data': data
  })
}

//视频详情
export function getMovieDetail(data) {
  return request({
    'url': '/ecmsapi/index.php?mod=movie&act=detail',
    headers: {
      isToken: false
    },
    'method': 'get',
    'data': data
  })
}

//视频列表
export function getMovieDetailMovieList(data) {
  return request({
    'url': '/ecmsapi/index.php?mod=movie&act=playlist',
    headers: {
      isToken: false
    },
    'method': 'get',
    'data': data
  })
}

//栏目列表
export function getClassList(data) {
  return request({
    'url': '/ecmsapi/index.php?mod=column&act=navigation',
    headers: {
      isToken: false
    },
    'method': 'get',
    'data': data
  })
}

// 当前栏目信息
export function geNavClassInfo(data) {
  return request({
    'url': '/ecmsapi/index.php?mod=column&act=navclassinfo',
    headers: {
      isToken: false
    },
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
