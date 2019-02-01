const { app, BrowserWindow } = require('electron')

let win

function createWindow () {
  win = new BrowserWindow({ width: 800, height: 600, show: false })

  win.loadURL('http://localhost/Timeshard/');
  win.setMenuBarVisibility(false);

  win.once('ready-to-show', () => {
    win.maximize()
    win.show()
  })
  
  //win.webContents.openDevTools()

  win.on('closed', () => {
    win = null
  })
}

app.on('ready', createWindow)

app.on('window-all-closed', () => {
  if (process.platform !== 'darwin') {
    app.quit()
  }
})

app.on('activate', () => {
  if (win === null) {
    createWindow()
  }
})
