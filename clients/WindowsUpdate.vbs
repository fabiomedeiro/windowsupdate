'This file has as objetive to check if there are any update, installing update though Windows Update and sending datas to database server  
'This function collects and sends data to database server through url. It also receives number of updates pending and status of update of machine  
function send_data_to_server(ByVal num_updates, ByVal win_status)
	'Setting variable with current user
        strUser = CreateObject("WScript.Network").UserName
	'Setting variable with name of machine
        strComputerName = CreateObject("WScript.Network").ComputerName
	'Setting variable with MacAddress of machine
        strTime =  FormatDateTime(now, vbLonTime)
        dim WMI:  set WMI = GetObject("winmgmts:\\.\root\cimv2")
        dim Nads: set Nads = WMI.ExecQuery("Select * from Win32_NetworkAdapter where physicaladapter=true")
        dim nad
        for each Nad in Nads
                if not isnull(Nad.MACAddress) then strMACAddress = Replace(Nad.MACAddress,":","")
        next
	'Seding datas to database server through url belloow
        myURL = "http://192.168.30.124/updates/add_user.php?mac="& strMACAddress &"&name="& strComputerName &"&username="& strUser &"&time="& strTime &"&status="& win_status &"&download="& num_updates
        Set req = CreateObject("MSXML2.XMLHTTP.6.0")
        req.Open "GET", myURL, False
        req.Send
        WScript.Echo req.ResponseText
end function

' Creating an object as Microsoft  update session
set updateSession = CreateObject("Microsoft.Update.Session")
updateSession.ClientApplicationID = "MSDN Sample Script"
'Setting updateSercher with function updateSession.CreateUpdateServer
Set updateSearcher = updateSession.CreateUpdateSearcher()

WScript.Echo "Searching for updates..." & vbCRLF
Set searchResult = _
updateSearcher.Search("AutoSelectOnWebSites=1 and IsInstalled=0")
'updateSearcher.Search("IsInstalled=0 and Type='Software' and IsHidden=0")

'Checking if there are any updates pending
If searchResult.Updates.Count > 0 Then
    'Calling funtions send_to_server to send datas to database server
    call send_data_to_server(searchResult.Updates.Count, "NO UPDATE")
    'Forcing Windows Updates to check and install updates	
    Set oShell = WScript.CreateObject("WSCript.shell")
    oShell.run "wuauclt /detectnow /updatenow"
    WScript.Quit
End If

'Checking if there is no update pending
If searchResult.Updates.Count = 0 Then
    WScript.Echo "There are no applicable updates."
    'Calling funtions send_to_server to send datas to database server
    call send_data_to_server(searchResult.Updates.Count, "UPDATE")
    WScript.Quit
End If

