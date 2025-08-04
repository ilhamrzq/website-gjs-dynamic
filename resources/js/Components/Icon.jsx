export default function Icon({ materialIcon, textIcon, textActive = false, classMaterial = '' }) {
  return (
    <div className="features flex flex-row items-center gap-4 justify-start">
      <div className="features-icon">
        <div className="features-icon__rounded flex flex-row justify-center items-center">
          <span className={`material-symbols-outlined ${classMaterial}`}>{materialIcon}</span>
        </div>
      </div>
      {textActive && (
        <div className="features-title flex flex-row">
          <h1 className="text-base font-semibold">{textIcon}</h1>
        </div>
      )}
    </div>
  );
}
