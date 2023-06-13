const getters = {
  token: state => state.user.token,
  user: state => state.user.user,
  avatar: state => state.user.avatar,
  name: state => state.user.name,
  roles: state => state.user.roles,
  permissions: state => state.user.permissions
}
export default getters
