using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.IO;

namespace HamSpace
{
    public class HamUtils
    {
        public static const string DECOY_NAME = "!";
        public static const string LOCKED_NAME = "!!";
    }
    public class ManagedApp
    {
        FileSystemWatcher fileDecoyWatch;
        FileStream fs;
        public ManagedApp(string installPath)
        {
            string installPathDecoy = installPath + "\\" + HamUtils.DECOY_NAME;
            string installPathLocked = installPath + "\\" + HamUtils.LOCKED_NAME;
            this.fileDecoyWatch = new FileSystemWatcher(installPathDecoy);
            fs = File.Open(installPathLocked, FileMode.Open, FileAccess.ReadWrite, FileShare.None);
            this.fileDecoyWatch.Deleted += new FileSystemEventHandler(fileDecoyWatch_Deleted);
        }

        void fileDecoyWatch_Deleted(object sender, FileSystemEventArgs e)
        {
            throw new NotImplementedException();
        }

        
    }
}
