import React, {
  useState,
  useEffect,
  useCallback,
  useRef,
  startTransition,
  memo,
  forwardRef,
} from "react";
import { Document, Page, pdfjs } from "react-pdf";
import HTMLFlipBook from "react-pageflip";
import BookCover from "../assets/images/book-cover.webp";
import { GrFormPrevious } from "react-icons/gr";
import { GrFormNext } from "react-icons/gr";

import "react-pdf/dist/Page/AnnotationLayer.css";
import "react-pdf/dist/Page/TextLayer.css";

// PDF Worker
pdfjs.GlobalWorkerOptions.workerSrc = `//unpkg.com/pdfjs-dist@${pdfjs.version}/build/pdf.worker.min.mjs`;

const A4_RATIO = 1.414;

/* ================= PAGE ================= */
interface PageProps {
  pageNumber: number;
  width: number;
  height: number;
}

const PageWrapper = memo(
  forwardRef<HTMLDivElement, PageProps>(
    ({ pageNumber, width, height }, ref) => (
      <div className="book-page" ref={ref} data-density="soft">
        <div className="page-content">
          <Page
            pageNumber={pageNumber}
            width={width}
            height={height}
            renderTextLayer={false}
            renderAnnotationLayer={false}
            loading={
              <div className="page-loader">
                <div className="mini-spinner" />
              </div>
            }
          />
          <div className="page-shadow" />
        </div>
      </div>
    )
  )
);

/* ================= COVER ================= */
const Cover = memo(
  forwardRef<HTMLDivElement, {}>(({}, ref) => (
    <div className="book-page cover-front" ref={ref} data-density="hard">
      <div className="page-content">
        <div
          className="cover-inner"
          style={{ backgroundImage: `url(${BookCover})` }}
        >
         
        </div>  
        <div className="page-shadow" />
      </div>
    </div>
  ))
);

/* ================= MAIN ================= */
const BookDetails: React.FC = () => {
  const [numPages, setNumPages] = useState<number | null>(null);
  const [currentPage, setCurrentPage] = useState(0);
  const [isMobile, setIsMobile] = useState(window.innerWidth < 768);
  const [dimensions, setDimensions] = useState({ width: 550, height: 750 });

  const flipBookRef = useRef<any>(null);

  /* ---------- Resize ---------- */
  const handleResize = useCallback(() => {
    const width = window.innerWidth;
    const mobile = width < 768;

    setIsMobile(mobile);

    const pageWidth = mobile
      ? Math.min(width - 20, 450)
      : Math.min((width - 240) / 2, 550);

    setDimensions({
      width: Math.floor(pageWidth),
      height: Math.floor(pageWidth * A4_RATIO),
    });
  }, []);

  useEffect(() => {
    handleResize();
    const resizeListener = () => {
      clearTimeout((window as any).__resizeTimer);
      (window as any).__resizeTimer = setTimeout(handleResize, 100);
    };
    window.addEventListener("resize", resizeListener);
    return () => window.removeEventListener("resize", resizeListener);
  }, [handleResize]);

  /* ---------- PDF Load ---------- */
  const onDocumentLoadSuccess = ({ numPages }: { numPages: number }) =>
    startTransition(() => setNumPages(numPages));

  /* ---------- Navigation ---------- */
  const flip = (dir: "next" | "prev") =>
    flipBookRef.current?.pageFlip()[dir === "next" ? "flipNext" : "flipPrev"]();

  const flipbookKey = isMobile ? "mobile" : "desktop";

  return (
    <div className="book-details-viewer">
      <div className="viewer-container">
        <h1 className="book-viewer-heading">WORLD, IN 2050</h1>

        <Document
          file="/book.pdf"
          onLoadSuccess={onDocumentLoadSuccess}
          loading={<div className="book-loader">Opening Book...</div>}
        >
          {numPages && (
            <div className="flipbook-wrapper">
              {!isMobile && <div className="" />}
              <button
                className="nav-arrow prev"
                onClick={() => flip("prev")}
                disabled={currentPage === 0}
              >
                <GrFormPrevious size={30}/>
              </button>

              <HTMLFlipBook
                key={flipbookKey}
                ref={flipBookRef}
                width={dimensions.width}
                height={dimensions.height}
                minWidth={200}
                maxWidth={800}
                minHeight={280}
                maxHeight={1130}
                size="fixed"
                startPage={0}
                drawShadow
                flippingTime={isMobile ? 600 : 800}
                usePortrait={isMobile}
                startZIndex={0}
                maxShadowOpacity={1}
                showCover
                autoSize
                mobileScrollSupport
                clickEventForward
                useMouseEvents
                onFlip={(e: any) => setCurrentPage(e.data)}
                swipeDistance={isMobile ? 15 : 30}
                showPageCorners={!isMobile}
                disableFlipByClick={false}
                className="pdf-flipbook"
                style={{ backgroundColor: "transparent" }}
              >
                <Cover  />

                {Array.from({ length: numPages }).map((_, i) => (
                  <PageWrapper
                    key={i}
                    pageNumber={i + 1}
                    width={dimensions.width}
                    height={dimensions.height}
                  />
                ))}
              </HTMLFlipBook>

              <button
                className="nav-arrow next"
                onClick={() => flip("next")}
                disabled={
                  currentPage >= numPages - (isMobile ? 1 : 2)
                }
              >
                <GrFormNext  size={30}/>
              </button>
            </div>
          )}
        </Document>

        {numPages && (
          <div className="page-counter">
            {isMobile
              ? `Page ${currentPage + 1} of ${numPages}`
              : `Pages ${currentPage + 1}-${Math.min(
                  currentPage + 2,
                  numPages
                )} of ${numPages}`}
          </div>
        )}
      </div>
    </div>
  );
};

export default BookDetails;