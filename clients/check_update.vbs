'This file has as objective to excute WindowsUpdate.vbs on background 
'Declaration of variable sh
dim sh
'Creation object as Wscript.shell 
set sh = WScript.CreateObject("WScript.shell")
'Running WindowsUpdate.vbs bellow 
sh.run "wscript WindowsUpdate.vbs //B"
'Seeting sh with  nothing
set sh = nothing
