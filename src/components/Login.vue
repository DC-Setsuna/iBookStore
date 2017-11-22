<template>
  <el-dialog title="iBook Store Login" :visible="this.$store.state.loginDialogVisible" :show-close="false">
    <el-tabs type="card" v-model="activeTab">
      <el-tab-pane label="登录" name="login">
        <el-form label-position="right" label-width="80px" :rules="loginRules" :model="formLabelLogin" ref="formLabelLogin">
          <el-form-item label="用户名" prop="username">
            <el-input v-model="formLabelLogin.username" auto-complete="off" spellcheck="false"></el-input>
          </el-form-item>
          <el-form-item label="密码" prop="password">
            <el-input v-model="formLabelLogin.password" type="password" auto-complete="off" spellcheck="false" @keyup.enter.native="submit"></el-input>
          </el-form-item>
          <el-form-item>
            <el-checkbox v-model="formLabelLogin.remember">记住密码</el-checkbox>
            <span style="margin-left:20px;color:#bbb;">密码有效时间为24小时</span>
          </el-form-item>
        </el-form>
      </el-tab-pane>
      <el-tab-pane label="注册" name="register">
        <el-form label-position="right" label-width="80px" :rules="registerRules" :model="formLabelRegister" ref="formLabelRegister">
          <el-form-item label="用户名" prop="username">
            <el-input v-model="formLabelRegister.username" auto-complete="off" spellcheck="false"></el-input>
          </el-form-item>
          <el-form-item label="密码" prop="password">
            <el-input v-model="formLabelRegister.password" type="password" auto-complete="off" spellcheck="false"></el-input>
          </el-form-item>
          <el-form-item label="确认密码" prop="verifyPassword">
            <el-input v-model="formLabelRegister.verifyPassword" type="password" auto-complete="off" spellcheck="false" @keyup.enter.native="submit"></el-input>
          </el-form-item>
        </el-form>
      </el-tab-pane>
    </el-tabs>
    <div slot="footer" class="dialog-footer">
      <el-button @click="closeDialog">取 消</el-button>
      <el-button type="primary" @click="submit">确 定</el-button>
    </div>
  </el-dialog>
</template>
<script>
export default {
  data() {
    var checkPass = (rule, value, callback) => {
      if (value === '') {
        callback(new Error('请再次输入密码'))
      } else if (value !== this.formLabelRegister.password) {
        callback(new Error('两次密码输入不一致'))
      }
      return
    };
    return {
      activeTab: 'login',
      formLabelLogin: {
        username: '',
        password: '',
        remember: true
      },
      formLabelRegister: {
        username: '',
        password: '',
        verifyPassword: ''
      },
      loginRules: {
        username: [
          { required: true, message: '请输入用户名', trigger: 'blur' },
          { min: 8, max: 15, message: '用户名长度在8-15位', trigger: 'blur' }
        ],
        password: [
          { required: true, message: '请输入密码', trigger: 'blur' },
          { min: 8, message: '密码大于8位', trigger: 'blur' }
        ]
      },
      registerRules: {
        username: [
          { required: true, message: '请输入用户名', trigger: 'blur' },
          { min: 8, max: 15, message: '用户名长度在8-15位', trigger: 'blur' }
        ],
        password: [
          { required: true, message: '请输入密码', trigger: 'blur' },
          { min: 8, message: '密码大于8位', trigger: 'blur' }
        ],
        verifyPassword: [
          { validator: checkPass, trigger: 'blur' }
        ]
      }
    }
  },
  methods: {
    closeDialog: function() {
      this.$refs['formLabelLogin'].resetFields()
      this.$refs['formLabelRegister'].resetFields()
      this.$store.commit('loginDialog')
    },
    login: function() {
      this.axios.get(this.$store.state.API + 'login.php', {
        params: this.formLabelLogin
      }).then((response) => {
        if (response.data['code'] === 202) {
          this.$message.error('密码错误')
          return
        } else if (response.data['code'] === 203) {
          this.$message.error('用户名不存在')
          return
        } else if (response.data['code'] === 200) {
          this.$notify({
            title: '登录成功',
            message: 'iBook Store',
            type: 'success',
            duration: 3000,
            offset: 70
          })
          this.$store.commit('login', this.formLabelLogin.username)
          this.closeDialog()
          this.updateCar()
        }
      })
    },
    register: function() {
      this.axios.get(this.$store.state.API + 'register.php', {
        params: this.formLabelRegister
      }).then((response) => {
        if (response.data['code'] === 201) {
          this.$message.error('用户名已存在')
          return
        } else if (response.data['code'] === 202) {
          this.$message.error('错误，请重新注册')
          return
        } else if (response.data['code'] === 200) {
          this.$notify({
            title: '注册成功',
            message: '已为您自动登录',
            type: 'success',
            duration: 3000,
            offset: 100
          })
          this.$store.commit('login', this.formLabelRegister.username)
          this.closeDialog()
          this.updateCar()
        }
      })
    },
    submit: function() {
      if (this.activeTab === 'login') {
        if (this.formLabelLogin.username === '') {
          this.$message.error('请填写用户名')
          return
        } else if (this.formLabelLogin.password === '') {
          this.$message.error('请填写用户名')
          return
        } else if (this.formLabelLogin.username.lenth < 8 || this.formLabelLogin.username.lenth > 15) {
          this.$message.error('用户名长度在8-15位')
          return
        } else if (this.formLabelLogin.password.lenth < 8) {
          this.error('密码应大于8位')
          return
        }
        this.login()
      } else if (this.activeTab === 'register') {
        if (this.formLabelRegister.username === '') {
          this.$message.error('请填写用户名')
          return
        } else if (this.formLabelRegister.password === '') {
          this.$message.error('请输入密码')
          return
        } else if (this.formLabelRegister.username.lenth < 8 || this.formLabelRegister.username.lenth > 15) {
          this.$message.error('用户名长度在8-15位')
          return
        } else if (this.formLabelRegister.password.lenth < 8) {
          this.$message.error('密码应大于8位')
          return
        } else if (this.formLabelRegister.password !== this.formLabelRegister.verifyPassword) {
          this.error('两次密码输入不一致')
          return
        }
        this.register()
      }
    },
    updateCar: function() {
      this.axios.get(this.$store.state.API + 'car.php', {
        params: {
          action: 'see',
          username: this.$store.state.username
        }
      }).then((response) => {
        if (response.data.code === 200) {
          var len = response.data.data.length
          this.$store.commit('addcar', len)
        }
      })
    }
  },
  created: function() {
    this.$on('close', function() {
      console.log(123)
    })
  }
}

</script>
<style>
.el-tabs__nav {
  width: 100%;
}

.el-tabs__item {
  width: 50%;
  text-align: center;
}

.el-form {
  margin: 30px 100px 0 100px;
}

</style>
