import upload from '@/utils/upload'
import request from '@/utils/request'

// 用户密码重置
export function updateUserPwd(data) {
  return request({
    url: '/ecmsapi/index.php?mod=user&act=updateuser',
    method: 'post',
    params: data
  })
}

// 查询用户个人信息
export function getUserProfile(data) {
  return request({
    url: '/ecmsapi/index.php?mod=user&act=userinfo',
    method: 'get',
	data:data
  })
}

// 修改用户个人信息
export function updateUserProfile(data) {
  return request({
    url: '/ecmsapi/index.php?mod=user&act=updateuserinfo',
    method: 'post',
    data: data
  })
}

// 用户头像上传
export function uploadAvatar(data) {
  return upload({
    url: '/ecmsapi/index.php?mod=user&act=uploaduserpic',
	data:data
    // name: data.name,
    // filePath: data.filePath
  })
}
