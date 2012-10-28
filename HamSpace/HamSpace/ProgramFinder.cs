using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using Microsoft.Win32;
using System.Collections;

namespace HamSpace
{
    class ProgramFinder
    {
        private void SearchForPrograms(RegistryKey currentKey)
        {
            object displayName = currentKey.GetValue("DisplayName");
            object uninstalString = currentKey.GetValue("UninstallString");
            object installString = currentKey.GetValue("InstallLocation");

            if (displayName != null && uninstalString != null && installString != null)
                if (displayName as string != "" && uninstalString as string != "" && installString as string != "")
                    AddToArray(displayName, installString, uninstalString);

            string[] subKeysArray = currentKey.GetSubKeyNames();
            foreach (string subKey in subKeysArray)
            {
                try
                {
                    RegistryKey newKey = currentKey.OpenSubKey(subKey);
                    if (newKey != null)
                        SearchForPrograms(currentKey.OpenSubKey(subKey));
                }
                catch (System.Security.SecurityException e)
                {
                }
            }
        }

        HashSet<string> programsList = new HashSet<string>();
        HashSet<string> installList = new HashSet<string>();
        HashSet<string> uninstallList = new HashSet<string>();

        Hashtable programTable = new Hashtable();
        private void AddToArray(object program, object install, object uninstall)
        {
            programsList.Add(program as string);
            installList.Add(install as string);
            uninstallList.Add(uninstall as string);

            //programTable.Add(program as string, install as string);
        }

        private void StartSearch()
        {
            String uninst = @"SOFTWARE\Microsoft\Windows\CurrentVersion\Uninstall";
            RegistryKey r = Registry.LocalMachine.OpenSubKey(uninst);
            SearchForPrograms(Registry.CurrentUser.OpenSubKey("Software"));
            SearchForPrograms(Registry.LocalMachine.OpenSubKey("SOFTWARE"));
            SearchForPrograms(r);
            return;
        }
    }
}
