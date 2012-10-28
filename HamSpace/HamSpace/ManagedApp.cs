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

    public class NotHamManageableException : Exception
    {
        public NotHamManageableException(string message)
            : base(message)
        {
        }
    }
    public class ManagedApp : IDisposable
    {
        FileSystemWatcher fileDecoyWatch;
        FileStream fs;
        public ManagedApp(string installPath)
        {
            string installPathDecoy = Path.Combine(installPath, HamUtils.DECOY_NAME);
            string installPathLocked = Path.Combine(installPath, HamUtils.LOCKED_NAME);

            if (!File.Exists(installPathDecoy))
            {
                FileStream decoyFS = File.Create(installPathDecoy);
                this.fileDecoyWatch = new FileSystemWatcher(installPathDecoy);
            }
            else
            {
                throw new NotHamManageableException("This is already managed by HAM, or something is really wrong.");
            }
            fs = File.Open(installPathLocked, FileMode.Open, FileAccess.ReadWrite, FileShare.None);
            this.fileDecoyWatch.Deleted += new FileSystemEventHandler(fileDecoyWatch_Deleted);
        }

        void fileDecoyWatch_Deleted(object sender, FileSystemEventArgs e)
        {
            throw new NotImplementedException();
        }

        public void Dispose()
        {
            Dispose(true);
            GC.SuppressFinalize(this);
        }

        protected virtual void Dispose(bool disposing)
        {
            throw new NotImplementedException();
        }
        
    }
}
